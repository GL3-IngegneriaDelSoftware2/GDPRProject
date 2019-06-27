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

class Event < ApplicationRecord
  belongs_to :event_typology

  # Validations
  validates :e_name, :e_description, :e_date_from, :e_date_to, :e_class, :e_state, presence: true

  # Retrieves all the events that are active or will be active within a certain time specified in {EventTypology} field ()early notification).
  # TODO Add the verification of participants using the current user in session
  # @param high_priority if set to true retrieves only events with priority set to 4 or 5
  # @return [Array<Event>] a set of events that should be notified to the user
  def self.get_all_notifications(high_priority: false)
    events = self.all
    events.select do |event|
      is_ongoing = event.e_date_from < DateTime.now && event.e_date_to > DateTime.now
      # is_imminent = event.e_date_from == DateTime.now + event.event_typology.et_early_notification # TODO uncomment or fix when et_early_notification is esatblished
      is_imminent = false # TODO remove
      is_important = event.event_typology.et_priority >= 4
      is_current_user_included = true # TODO Fix with correct value from Devise

      if high_priority
        event if is_current_user_included && is_important && (is_imminent || is_ongoing)
      else
        event if is_current_user_included && (is_ongoing || is_imminent)
      end
    end
  end

end
