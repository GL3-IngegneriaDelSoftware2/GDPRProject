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

require 'test_helper'

class EventTest < ActiveSupport::TestCase
  # test "the truth" do
  #   assert true
  # end
end
