# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.

ActiveRecord::Schema.define(version: 2019_07_02_142030) do

  create_table "event_typologies", force: :cascade do |t|
    t.string "et_name"
    t.integer "et_priority"
    t.integer "et_early_notification"
    t.string "et_event_repeat"
    t.string "et_color"
    t.datetime "created_at", null: false
    t.datetime "updated_at", null: false
  end

  create_table "events", force: :cascade do |t|
    t.integer "event_typology_id"
    t.string "e_name"
    t.string "e_description"
    t.datetime "e_date_from"
    t.datetime "e_date_to"
    t.string "e_class"
    t.string "e_state"
    t.string "e_participants"
    t.string "e_notes"
    t.datetime "e_actual_start"
    t.datetime "e_actual_end"
    t.datetime "created_at", null: false
    t.datetime "updated_at", null: false
    t.index ["event_typology_id"], name: "index_events_on_event_typology_id"
  end

  create_table "users", force: :cascade do |t|
    t.string "email", default: "", null: false
    t.string "encrypted_password", default: "", null: false
    t.boolean "is_system_admin", default: false, null: false
    t.string "reset_password_token"
    t.datetime "reset_password_sent_at"
    t.datetime "remember_created_at"
    t.datetime "created_at", null: false
    t.datetime "updated_at", null: false
    t.index ["email"], name: "index_users_on_email", unique: true
    t.index ["reset_password_token"], name: "index_users_on_reset_password_token", unique: true
  end

end
