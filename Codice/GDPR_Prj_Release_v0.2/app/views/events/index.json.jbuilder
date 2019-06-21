# json.array! @events, partial: "events/event", as: :event

json.array!(@events) do |event|
  json.extract! event, :id
  json.title event.e_name
  json.start event.e_date_from
  json.end event.e_date_to
  json.color event.event_typology.et_color
  json.url event_url(event, format: :html)
end