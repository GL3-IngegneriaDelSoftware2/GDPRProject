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

ap "Cleaning database...."
EventTypology.destroy_all
Event.destroy_all
ap "Database clean!"
ap "Creating typologies..."

event_typology_names.each do |name|
  EventTypology.create(
         et_name: name,
         et_priority: rand(5)+1,
         et_early_notification: rand(48)+1,
         et_color: Faker::Color.hex_color
  )
end
ap "Typologies created!"
ap "Creating events..."
50.times do

  event_date_from = Faker::Time.between(DateTime.now - 20, DateTime.now + 5)

  Event.create(
           e_name: Faker::Games::Pokemon.name,
           e_notes: Faker::Quote.most_interesting_man_in_the_world,
           e_description: Faker::JapaneseMedia::DragonBall.character,
           e_date_from: event_date_from,
           e_date_to: event_date_from + rand(150000),
           event_typology: EventTypology.all[rand(EventTypology.count)],
           e_class: 'Classe',
           e_state: ''
  )
end

ap "Events created!"
ap "**** Seed done correctly! ****"