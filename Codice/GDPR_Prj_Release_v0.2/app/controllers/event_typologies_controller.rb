class EventTypologiesController < ApplicationController
  before_action :set_event_typology, only: [:show, :edit, :update, :destroy]

  # GET /event_typologies
  # GET /event_typologies.json
  def index
    @event_typologies = EventTypology.all
  end

  # GET /event_typologies/1
  # GET /event_typologies/1.json
  def show
  end

  # GET /event_typologies/new
  def new
    @event_typology = EventTypology.new
  end

  # GET /event_typologies/1/edit
  def edit
  end

  # POST /event_typologies
  # POST /event_typologies.json
  def create
    @event_typology = EventTypology.new(event_typology_params)

    respond_to do |format|
      if @event_typology.save
        format.html { redirect_to @event_typology, notice: 'La tipologia è stata creata correttamente.' }
        format.json { render :show, status: :created, location: @event_typology }
      else
        format.html { render :new }
        format.json { render json: @event_typology.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /event_typologies/1
  # PATCH/PUT /event_typologies/1.json
  def update
    respond_to do |format|
      if @event_typology.update(event_typology_params)
        format.html { redirect_to event_typologies_path, notice: 'La tipologia è stata modificata correttamente.' }
        format.json { render :show, status: :ok, location: @event_typology }
      else
        format.html { render :edit }
        format.json { render json: @event_typology.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /event_typologies/1
  # DELETE /event_typologies/1.json
  def destroy
    @event_typology.destroy
    respond_to do |format|
      format.html { redirect_to event_typologies_url, notice: 'La tipologia è stata cancellata correttamente.' }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_event_typology
      @event_typology = EventTypology.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def event_typology_params
      params.require(:event_typology).permit(:et_name, :et_priority, :et_early_notification, :et_event_repeat, :et_color)
    end
end
