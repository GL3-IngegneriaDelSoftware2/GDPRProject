# == Schema Information
#
# Table name: events
#
#  id                :integer          not null, primary key
#  event_typology_id :integer
#  e_name            :string
#  e_description     :string
#  e_date_from       :datetime
#  e_date_to         :datetime
#  e_class           :string
#  e_state           :string
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
end
