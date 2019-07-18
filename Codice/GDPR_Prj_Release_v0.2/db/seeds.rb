# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rails db:seed command (or created alongside the database with db:setup).
#
# Examples:
#
#   movies = Movie.create([{ name: 'Star Wars' }, { name: 'Lord of the Rings' }])
#   Character.create(name: 'Luke', movie: movies.first)

event_typology_names = [
    'Corso di formazione',
    'Richiesta esercizio diritti',
    'Databreach',
    'Manutenzione'
]

event_names_normal = ['Colloquio con nuovo professore',
                      'Riunione interna',
                      'Seminario Donatori di Sangue',
                      'Corso di aggiornamento',
                      'Manutenzione',
                      'Compilazione richieste di immatricolazione']
event_names_high = ['Rischio per la sicurezza dei dati',
                    'Richiesta revisione documenti Unno Attilia']


ap "Cleaning database...."
EventTypology.destroy_all
Event.destroy_all
ap "Database clean!"
ap "Creating typologies..."

# event_typology_names.each do |name|
#   EventTypology.create(
#       et_name: name,
#       et_priority: rand(5) + 1,
#       et_early_notification: rand(48) + 1,
#       et_color: Faker::Color.hex_color
#   )
EventTypology.create(
    et_name: event_typology_names[0],
    et_priority: 1,
    et_early_notification: 5,
    et_color: Faker::Color.hex_color
)

EventTypology.create(
    et_name: event_typology_names[1],
    et_priority: 4,
    et_early_notification: 10,
    et_color: Faker::Color.hex_color
)

EventTypology.create(
    et_name: event_typology_names[2],
    et_priority: 5,
    et_early_notification: 30,
    et_color: Faker::Color.hex_color
)

EventTypology.create(
    et_name: event_typology_names[3],
    et_priority: 2,
    et_early_notification: 7,
    et_color: Faker::Color.hex_color
)


ap "Typologies created!"

ap "Creating events..."
# 50.times do
#

#
#   Event.create(
#       e_name: Faker::Games::Pokemon.name,
#       e_notes: Faker::Quote.most_interesting_man_in_the_world,
#       e_description: Faker::JapaneseMedia::DragonBall.character,
#       e_date_from: event_date_from,
#       e_date_to: event_date_from + rand(150000),
#       event_typology: EventTypology.all[rand(EventTypology.count)],
#       e_class: 'Task',
#       e_state: ''
#   )
# end

event_names_normal.each do |event|
  event_date_from = Faker::Time.between(DateTime.now - 2, DateTime.now + 10)
  participants = User.all.map {|u| u.id}

  all_normal_priority = EventTypology.all.select {|et| et.et_priority < 4}

  Event.create(
      e_name: event,
      e_notes: Faker::JapaneseMedia::DragonBall.character + " " + Faker::Games::Pokemon.name,
      e_description: Faker::Quote.most_interesting_man_in_the_world,
      e_date_from: event_date_from,
      e_date_to: event_date_from + rand(150000),
      event_typology: all_normal_priority[rand(all_normal_priority.size)],
      e_class: 'Task',
      e_state: participants.join(";"),
      e_participants: participants.join(";"))
end

event_date_from = Faker::Time.between(DateTime.now - 2, DateTime.now + 20)
participants = User.all.map {|u| u.id}

Event.create(
    e_name: event_names_high[0],
    e_notes: Faker::JapaneseMedia::DragonBall.character + Faker::Games::Pokemon.name,
    e_description: Faker::Quote.most_interesting_man_in_the_world,
    e_date_from: event_date_from,
    e_date_to: event_date_from + rand(150000),
    event_typology: EventTypology.all.detect {|et| et.et_priority == 5},
    e_class: 'Task',
    e_state: participants.join(";"),
    e_participants: participants.join(";"))

event_date_from = Faker::Time.between(DateTime.now - 1, DateTime.now + 10)

Event.create(
    e_name: event_names_high[1],
    e_notes: Faker::JapaneseMedia::DragonBall.character + Faker::Games::Pokemon.name,
    e_description: Faker::Quote.most_interesting_man_in_the_world,
    e_date_from: event_date_from,
    e_date_to: event_date_from + rand(150000),
    event_typology: EventTypology.all.detect {|et| et.et_priority == 4},
    e_class: 'Task',
    e_state: participants.join(";"),
    e_participants: participants.join(";"))

ap "Events created!"
ap "**** Seed done correctly! ****"