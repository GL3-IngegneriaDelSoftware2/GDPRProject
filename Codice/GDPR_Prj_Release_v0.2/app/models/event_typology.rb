# == Schema Information
#
# Table name: event_typologies
#
#  id                    :integer          not null, primary key
#  et_name               :string
#  et_priority           :integer
#  et_early_notification :integer
#  et_event_repeat       :string
#  et_color              :string
#  created_at            :datetime         not null
#  updated_at            :datetime         not null
#
# == About the class
# This class represents the event typology, for more information on the event typology read the relative documentation
# For more information on schema data read the documentation of the database

class EventTypology < ApplicationRecord
  has_many :events, dependent: :destroy

  # Validations

  validates :et_name, :et_early_notification, presence: true
  validates :et_priority, inclusion: { in: (1..5), message: "%{value} is not a valid size" }

end
