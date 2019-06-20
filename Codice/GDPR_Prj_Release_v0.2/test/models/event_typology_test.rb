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

require 'test_helper'

class EventTypologyTest < ActiveSupport::TestCase
  # test "the truth" do
  #   assert true
  # end
end
