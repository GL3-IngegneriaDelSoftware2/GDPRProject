# == Route Map
#
#                    Prefix Verb   URI Pattern                                                                              Controller#Action
#          event_typologies GET    /event_typologies(.:format)                                                              event_typologies#index
#                           POST   /event_typologies(.:format)                                                              event_typologies#create
#        new_event_typology GET    /event_typologies/new(.:format)                                                          event_typologies#new
#       edit_event_typology GET    /event_typologies/:id/edit(.:format)                                                     event_typologies#edit
#            event_typology GET    /event_typologies/:id(.:format)                                                          event_typologies#show
#                           PATCH  /event_typologies/:id(.:format)                                                          event_typologies#update
#                           PUT    /event_typologies/:id(.:format)                                                          event_typologies#update
#                           DELETE /event_typologies/:id(.:format)                                                          event_typologies#destroy
#                    events GET    /events(.:format)                                                                        events#index
#                           POST   /events(.:format)                                                                        events#create
#                 new_event GET    /events/new(.:format)                                                                    events#new
#                edit_event GET    /events/:id/edit(.:format)                                                               events#edit
#                     event GET    /events/:id(.:format)                                                                    events#show
#                           PATCH  /events/:id(.:format)                                                                    events#update
#                           PUT    /events/:id(.:format)                                                                    events#update
#                           DELETE /events/:id(.:format)                                                                    events#destroy
#                           POST   /notif/hide/:id(.:format)                                                                home#hide
#                           POST   /notif/close/:id(.:format)                                                               home#close
#                      root GET    /                                                                                        home#index
#        rails_service_blob GET    /rails/active_storage/blobs/:signed_id/*filename(.:format)                               active_storage/blobs#show
# rails_blob_representation GET    /rails/active_storage/representations/:signed_blob_id/:variation_key/*filename(.:format) active_storage/representations#show
#        rails_disk_service GET    /rails/active_storage/disk/:encoded_key/*filename(.:format)                              active_storage/disk#show
# update_rails_disk_service PUT    /rails/active_storage/disk/:encoded_token(.:format)                                      active_storage/disk#update
#      rails_direct_uploads POST   /rails/active_storage/direct_uploads(.:format)                                           active_storage/direct_uploads#create

Rails.application.routes.draw do
  resources :event_typologies
  resources :events

  post 'notif/hide/:id', to: "home#hide"
  post 'notif/close/:id', to: "home#close"

  root to: 'home#index'
  # For details on the DSL available within this file, see http://guides.rubyonrails.org/routing.html
end
