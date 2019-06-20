json.extract! event_typology, :id, :events_id, :et_name, :et_priority, :et_early_notification, :et_event_repeat, :et_color, :created_at, :updated_at
json.url event_typology_url(event_typology, format: :json)
