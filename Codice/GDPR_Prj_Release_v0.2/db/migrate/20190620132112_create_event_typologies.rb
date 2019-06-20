class CreateEventTypologies < ActiveRecord::Migration[5.2]
  def change
    create_table :event_typologies do |t|
      t.string :et_name
      t.integer :et_priority
      t.integer :et_early_notification
      t.string :et_event_repeat
      t.string :et_color

      t.timestamps
    end
  end
end
