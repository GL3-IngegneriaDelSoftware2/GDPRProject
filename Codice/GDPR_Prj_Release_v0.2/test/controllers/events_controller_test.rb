require 'test_helper'

class EventsControllerTest < ActionDispatch::IntegrationTest
  setup do
    @event = events(:one)
  end

  test "should get index" do
    get events_url
    assert_response :success
  end

  test "should get new" do
    get new_event_url
    assert_response :success
  end

  test "should create event" do
    assert_difference('Event.count') do
      post events_url, params: { event: { e_actual_end: @event.e_actual_end, e_actual_start: @event.e_actual_start, e_class: @event.e_class, e_date_from: @event.e_date_from, e_date_to: @event.e_date_to, e_description: @event.e_description, e_name: @event.e_name, e_notes: @event.e_notes, e_participants: @event.e_participants, e_state: @event.e_state, e_typology: @event.e_typology } }
    end

    assert_redirected_to event_url(Event.last)
  end

  test "should show event" do
    get event_url(@event)
    assert_response :success
  end

  test "should get edit" do
    get edit_event_url(@event)
    assert_response :success
  end

  test "should update event" do
    patch event_url(@event), params: { event: { e_actual_end: @event.e_actual_end, e_actual_start: @event.e_actual_start, e_class: @event.e_class, e_date_from: @event.e_date_from, e_date_to: @event.e_date_to, e_description: @event.e_description, e_name: @event.e_name, e_notes: @event.e_notes, e_participants: @event.e_participants, e_state: @event.e_state, e_typology: @event.e_typology } }
    assert_redirected_to event_url(@event)
  end

  test "should destroy event" do
    assert_difference('Event.count', -1) do
      delete event_url(@event)
    end

    assert_redirected_to events_url
  end
end
