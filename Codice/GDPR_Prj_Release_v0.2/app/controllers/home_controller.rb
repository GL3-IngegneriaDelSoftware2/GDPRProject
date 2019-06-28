class HomeController < ApplicationController
  skip_before_action :verify_authenticity_token
  def index

  end

  # Closes the notification, current user will not be able to visualize this notification again with current state
  # @param id the id of the event which notification will not be displayed
  def close
    p "CLOSING #{params[:id]}"

  end

  # Hides a notification until next session for current user
  # @param id the id of the event which notificaion will be hidden
  def hide
    p "HIDING #{params[:id]}"
    if session[:hidden_notifications]
      session[:hidden_notifications].push(params[:id]) unless session[:hidden_notifications].include? params[:id]
    else
      session[:hidden_notifications] = [params[:id]]
    end
  end
end