require 'test_helper'

class EventTypologiesControllerTest < ActionDispatch::IntegrationTest
  setup do
    @event_typology = event_typologies(:one)
  end

  test "should get index" do
    get event_typologies_url
    assert_response :success
  end

  test "should get new" do
    get new_event_typology_url
    assert_response :success
  end

  test "should create event_typology" do
    assert_difference('EventTypology.count') do
      post event_typologies_url, params: { event_typology: { et_color: @event_typology.et_color, et_early_notification: @event_typology.et_early_notification, et_event_repeat: @event_typology.et_event_repeat, et_name: @event_typology.et_name, et_priority: @event_typology.et_priority, events_id: @event_typology.events_id } }
    end

    assert_redirected_to event_typology_url(EventTypology.last)
  end

  test "should show event_typology" do
    get event_typology_url(@event_typology)
    assert_response :success
  end

  test "should get edit" do
    get edit_event_typology_url(@event_typology)
    assert_response :success
  end

  test "should update event_typology" do
    patch event_typology_url(@event_typology), params: { event_typology: { et_color: @event_typology.et_color, et_early_notification: @event_typology.et_early_notification, et_event_repeat: @event_typology.et_event_repeat, et_name: @event_typology.et_name, et_priority: @event_typology.et_priority, events_id: @event_typology.events_id } }
    assert_redirected_to event_typology_url(@event_typology)
  end

  test "should destroy event_typology" do
    assert_difference('EventTypology.count', -1) do
      delete event_typology_url(@event_typology)
    end

    assert_redirected_to event_typologies_url
  end
end
