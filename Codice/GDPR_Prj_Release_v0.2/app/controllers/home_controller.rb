class HomeController < ApplicationController
  before_action :authenticate_user!
  skip_before_action :verify_authenticity_token

  def index

  end

  # Closes the notification, current user will not be able to visualize this notification again with current state
  # @param id the id of the event which notification will not be displayed
  def close
    ap "CLOSING #{params[:id]}"
    @event = Event.find(params[:id])
    user_ids = @event.e_state&.split(";")
    if user_ids.include? current_user.id.to_s # if the user is included in participants, then remove it from the state
      user_ids.delete(current_user.id.to_s)
      @event.e_state = user_ids.join(";")
      @event.save
    end

  end

  # Hides a notification until next session for current user
  # @param id the id of the event which notificaion will be hidden
  def hide
    ap "HIDING #{params[:id]}"
    if session[:hidden_notifications]
      session[:hidden_notifications].push(params[:id]) unless session[:hidden_notifications].include? params[:id]
    else
      session[:hidden_notifications] = [params[:id]]
    end
  end

  def fake_data_breach

    @event_typology = EventTypology.all.detect {|et| et.et_priority == 5}
    if @event_typology

      @participants = User.all.map {|u| u.id}
      @new_event = Event.create(e_name: "Databreach Fittizio per Test",
                                e_description: "Databreach Finto per il test della gestione in caso di Databreach reale",
                                e_date_from: DateTime.now,
                                e_date_to: DateTime.now + 3,
                                e_participants: @participants.join(";"),
                                e_state: @participants.join(";"),
                                e_class: "Evento",
                                event_typology: @event_typology
      )

    end
    redirect_to @new_event
  end

  def fake_request

    @event_typology = EventTypology.all.detect {|et| et.et_priority == 4}
    if @event_typology

      @participants = User.all.map {|u| u.id}
      @new_event = Event.create(e_name: "Richiesta di Esercizio Diritti Fittizio per Test",
                                e_description: "Richiesta di Esercizio Diritti Finta per il test della gestione in caso di Richiesta di Esercizio Diritti reale",
                                e_date_from: DateTime.now,
                                e_date_to: DateTime.now + 20,
                                e_participants: @participants.join(";"),
                                e_state: @participants.join(";"),
                                e_class: "Evento",
                                event_typology: @event_typology
      )

    end
    redirect_to @new_event
  end
end