class EventsController < ApplicationController
  before_action :set_event, only: [:show, :edit, :update, :destroy]
  skip_before_action :verify_authenticity_token

  # GET /events
  # GET /events.json
  def index
  if current_user.is_system_admin
    @events = Event.all.sort_by &:e_date_from # admin => mostro tutti gli eventi
  else
    all_events = Event.all.sort_by &:e_date_from # prendo tutti gli eventi
	@events = [] # array che conterra gli eventi
	all_events.each do |event|
	p event
	  if !event.e_participants.nil? # se ci sono partecipanti
	    if event.e_participants.split(";").include?(current_user.id.to_s) 
	      @events << event # tengo gli eventi in cui l'utente e' fra i partecipanti
	    end
      end
	end
  end
  end

  # GET /events/1
  # GET /events/1.json
  def show
  end

  # GET /events/new
  def new
    @event = Event.new
  end

  # GET /events/1/edit
  def edit
  end

  # POST /events
  # POST /events.json
  def create
    # Converto l'array in una stringa separata da ;
    params[:event]["e_participants"] = params[:event]["e_participants"].drop(1).join(";")
    # Inizialmente lo stato e' l'elenco dei partecipanti
    params[:event]["e_state"] = params[:event]["e_participants"]

    @event = Event.create(event_params)

    # Stato = ai partecipanti quando creo un evento
    if @event.e_state.nil?
      @event.e_state = @event.e_participants
    end

    respond_to do |format|
      if @event.save
        format.html {redirect_to @event, notice: 'L\' evento è stato creato correttamente.'}
        format.json {render :show, status: :created, location: @event}
      else
        format.html {render :new}
        format.json {render json: @event.errors, status: :unprocessable_entity}
      end
    end
  end

  # PATCH/PUT /events/1
  # PATCH/PUT /events/1.json
  def update
    # Converto l'array in una stringa separata da ;
    params[:event]["e_participants"] = params[:event]["e_participants"].drop(1).join(";")
    # Inizialmente lo stato e' l'elenco dei partecipanti
    params[:event]["e_state"] = params[:event]["e_participants"]

    respond_to do |format|
      if @event.update(event_params)
        format.html {redirect_to events_path, notice: 'L\' evento è stato modificato correttamente.'}
        format.json {render :show, status: :ok, location: @event}
      else
        format.html {render :edit}
        format.json {render json: @event.errors, status: :unprocessable_entity}
      end
    end
  end

  # DELETE /events/1
  # DELETE /events/1.json
  def destroy
    @event.destroy
    respond_to do |format|
      format.html {redirect_to events_url, notice: 'L\' evento è stato cancellato correttamente.'}
      format.json {head :no_content}
    end
  end

  def search

    @valid_events = Event.all.select{|e| e.e_participants&.split(";")&.include? current_user.id.to_s}
    
    @events = @valid_events.map{|event| event if event.e_name.include?(params[:query]) || event.event_typology.et_name.include?(params[:query])}

    if @events.compact.size == 0
      @events = nil
    end
    render "index"
  end

  private

  # Use callbacks to share common setup or constraints between actions.
  def set_event
    @event = Event.find(params[:id])
  end

  # Never trust parameters from the scary internet, only allow the white list through.
  def event_params
    params.require(:event).permit(:event_typology_id, :e_name, :e_description, :e_date_from, :e_date_to, :e_class, :e_notes, :e_actual_start, :e_actual_end, :query, :e_state, :e_participants)
  end
end
