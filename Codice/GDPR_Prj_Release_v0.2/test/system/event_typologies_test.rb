require "application_system_test_case"

class EventTypologiesTest < ApplicationSystemTestCase
  setup do
    @event_typology = event_typologies(:one)
  end

  test "visiting the index" do
    visit event_typologies_url
    assert_selector "h1", text: "Event Typologies"
  end

  test "creating a Event typology" do
    visit event_typologies_url
    click_on "New Event Typology"

    fill_in "Et color", with: @event_typology.et_color
    fill_in "Et early notification", with: @event_typology.et_early_notification
    fill_in "Et event repeat", with: @event_typology.et_event_repeat
    fill_in "Et name", with: @event_typology.et_name
    fill_in "Et priority", with: @event_typology.et_priority
    fill_in "Events", with: @event_typology.events_id
    click_on "Create Event typology"

    assert_text "Event typology was successfully created"
    click_on "Back"
  end

  test "updating a Event typology" do
    visit event_typologies_url
    click_on "Edit", match: :first

    fill_in "Et color", with: @event_typology.et_color
    fill_in "Et early notification", with: @event_typology.et_early_notification
    fill_in "Et event repeat", with: @event_typology.et_event_repeat
    fill_in "Et name", with: @event_typology.et_name
    fill_in "Et priority", with: @event_typology.et_priority
    fill_in "Events", with: @event_typology.events_id
    click_on "Update Event typology"

    assert_text "Event typology was successfully updated"
    click_on "Back"
  end

  test "destroying a Event typology" do
    visit event_typologies_url
    page.accept_confirm do
      click_on "Destroy", match: :first
    end

    assert_text "Event typology was successfully destroyed"
  end
end
