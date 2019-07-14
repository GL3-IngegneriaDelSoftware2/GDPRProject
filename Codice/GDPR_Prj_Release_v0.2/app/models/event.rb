# == Schema Information
#
# Table name: events
#
#  id                :integer          not null, primary key
#  event_typology_id :integer
#  e_name            :string           not null
#  e_description     :string           not null
#  e_date_from       :datetime         not null
#  e_date_to         :datetime         not null
#  e_class           :string           not null
#  e_state           :string           not null
#  e_participants    :string
#  e_notes           :string
#  e_actual_start    :datetime
#  e_actual_end      :datetime
#  created_at        :datetime         not null
#  updated_at        :datetime         not null
#
# == About the class
# This class represents the event, for more information on the events of the system read the relative documentation
# For more information on schema data read the documentation of the database

class Event < ApplicationRecord
  belongs_to :event_typology

  # Validations
  validates :e_name, :e_description, :e_date_from, :e_date_to, :e_class, presence: true

  # Retrieves all the events that are active or will be active within a certain time specified in {EventTypology} field ()early notification).
  # Events hidden (which id appears in session[:hidden_notifications]) will not be shown
  # @param hidden_notifications array retrieved from session in the calling view, contains the ids of hidden notifications
  # @param high_priority if set to true retrieves only events with priority set to 4 or 5
  # @return [Array<Event>] a set of events that should be notified to the user
  def self.get_all_notifications(hidden_notifications, current_user_id, high_priority: false)
    events = self.all
    events.select do |event|

      early_notif = event.event_typology.et_early_notification
      notif_start_day = event.e_date_from - (early_notif * 86400)
      # notif_end_day = event.e_date_to

      # By default an early notification will start at 8AM the number of days specified in early_notification
      # before the event e_date_from
      notification_start = DateTime.new(notif_start_day.year, notif_start_day.month, notif_start_day.day, 8, 0, 0, "+0200") # WARNING: Maybe a problem with offset
      is_hidden = hidden_notifications&.include? event.id.to_s
      is_imminent = DateTime.now > notification_start && event.e_date_to > DateTime.now
      is_ongoing = event.e_date_from < DateTime.now && event.e_date_to > DateTime.now
      is_important = event.event_typology.et_priority >= 4
      # is_over = DateTime.now < notif_end_day
      is_current_user_included = event.e_state&.split(";")&.include? current_user_id.to_s || false
      if event.e_state&.length && event.e_participants&.length
        important_event_solved = event.e_state&.length < event.e_participants&.length ? true : false # If the length of the state is lesser than the length of participants, it means someone resolved the event
      else
        important_event_solved = false
      end

      ap event.e_name
      ap "hidden: #{is_hidden}, cuz: #{hidden_notifications} and #{event.id}"
      ap "immin: #{is_imminent}"
      ap "ongoing: #{is_ongoing}"
      ap "important: #{is_important}"
      ap "current: #{is_current_user_included}"
      ap "solved : #{important_event_solved}"

      if high_priority
        event if !is_hidden && is_current_user_included && is_important && !important_event_solved && (is_imminent || is_ongoing)
      else
        event if !is_hidden && is_current_user_included && !is_important && (is_imminent || is_ongoing)
      end
    end
  end
end
