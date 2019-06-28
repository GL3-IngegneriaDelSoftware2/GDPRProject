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
  validates :e_name, :e_description, :e_date_from, :e_date_to, :e_class, :e_state, presence: true

  # Retrieves all the events that are active or will be active within a certain time specified in {EventTypology} field ()early notification).
  # Events hidden (which id appears in session[:hidden_notifications]) will not be shown
  # TODO Add the verification of participants using the current user in session
  # @param hidden_notifications array retrieved from session in the calling view, contains the ids of hidden notifications
  # @param high_priority if set to true retrieves only events with priority set to 4 or 5
  # @return [Array<Event>] a set of events that should be notified to the user
  def self.get_all_notifications(hidden_notifications, high_priority: false)
    events = self.all
    events.select do |event|

      # is_imminent = event.e_date_from == DateTime.now + event.event_typology.et_early_notification
      early_notif = event.event_typology.et_early_notification
      notif_start_day = event.e_date_from - (early_notif * 86400)

      # By default an early notification will start at 8AM the number of days specified in early_notification
      # before the event e_date_from
      notification_start = DateTime.new(notif_start_day.year, notif_start_day.month, notif_start_day.day, 8, 0, 0, "+0200") # WARNING: Maybe a problem with offset
      is_not_hidden = hidden_notifications.include? event.id ? false : true # verifies if the event id is hidden
      is_imminent = DateTime.now > notification_start
      is_ongoing = event.e_date_from < DateTime.now && event.e_date_to > DateTime.now
      is_important = event.event_typology.et_priority >= 4
      is_current_user_included = true # TODO Fix with correct value from Devise

      ap early_notif
      ap notif_start_day
      ap notification_start
      ap is_imminent

      if high_priority
        event if is_not_hidden && is_current_user_included && is_important && (is_imminent || is_ongoing)
      else
        event if is_not_hidden && is_current_user_included && !is_important && (is_imminent || is_ongoing)
      end
    end
  end

end
