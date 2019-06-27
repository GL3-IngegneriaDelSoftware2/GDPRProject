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


end
