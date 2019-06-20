require "application_system_test_case"

class EventsTest < ApplicationSystemTestCase
  setup do
    @event = events(:one)
  end

  test "visiting the index" do
    visit events_url
    assert_selector "h1", text: "Events"
  end

  test "creating a Event" do
    visit events_url
    click_on "New Event"

    fill_in "E actual end", with: @event.e_actual_end
    fill_in "E actual start", with: @event.e_actual_start
    fill_in "E class", with: @event.e_class
    fill_in "E date from", with: @event.e_date_from
    fill_in "E date to", with: @event.e_date_to
    fill_in "E description", with: @event.e_description
    fill_in "E name", with: @event.e_name
    fill_in "E notes", with: @event.e_notes
    fill_in "E participants", with: @event.e_participants
    fill_in "E state", with: @event.e_state
    fill_in "E typology", with: @event.e_typology
    click_on "Create Event"

    assert_text "Event was successfully created"
    click_on "Back"
  end

  test "updating a Event" do
    visit events_url
    click_on "Edit", match: :first

    fill_in "E actual end", with: @event.e_actual_end
    fill_in "E actual start", with: @event.e_actual_start
    fill_in "E class", with: @event.e_class
    fill_in "E date from", with: @event.e_date_from
    fill_in "E date to", with: @event.e_date_to
    fill_in "E description", with: @event.e_description
    fill_in "E name", with: @event.e_name
    fill_in "E notes", with: @event.e_notes
    fill_in "E participants", with: @event.e_participants
    fill_in "E state", with: @event.e_state
    fill_in "E typology", with: @event.e_typology
    click_on "Update Event"

    assert_text "Event was successfully updated"
    click_on "Back"
  end

  test "destroying a Event" do
    visit events_url
    page.accept_confirm do
      click_on "Destroy", match: :first
    end

    assert_text "Event was successfully destroyed"
  end
end
