class CreateEvents < ActiveRecord::Migration[5.2]
  def change
    create_table :events do |t|
      t.references :event_typology, foreign_key: true
      t.string :e_name
      t.string :e_description
      t.datetime :e_date_from
      t.datetime :e_date_to
      t.string :e_class
      t.string :e_state
      t.string :e_participants
      t.string :e_notes
      t.datetime :e_actual_start
      t.datetime :e_actual_end
      t.timestamps
    end
  end
end
