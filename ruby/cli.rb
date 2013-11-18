begin
  require 'rubygems'
  require 'oauth'
  require 'json'

  puts "Please open the following URL in your browser:"
  puts " https://dev.xing.com/applications"
  print "and enter the consumer key: "
  consumer_key = gets.strip

  print "enter the consumer secret here: "
  consumer_secret = gets.strip

  consumer = OAuth::Consumer.new(consumer_key, consumer_secret, {
    :site => "https://api.xing.com",
    :request_token_path => "/v1/request_token",
    :authorize_path => "/v1/authorize",
    :access_token_path => "/v1/access_token"
  })

  # Step 1: Obtain a request token
  # more info -> https://dev.xing.com/docs/authentication#call_v1_request_token
  puts "Starting oauth handshake, ask for request token..."
  request_token = consumer.get_request_token

  # Step 2: Obtain user authorization
  # more info -> https://dev.xing.com/docs/authentication#call_v1_authorize
  authorize_url = request_token.authorize_url
  puts "Please open the following URL in your browser:"
  puts "#{authorize_url}"
  print "and enter the PIN here: "
  verifier = gets.strip

  # Step 3: Exchange the authorized request token for an access token
  # more info -> https://dev.xing.com/docs/authentication#call_v1_access_token
  puts "Exchanging request token for your access token..."
  access_token = request_token.get_access_token(:oauth_verifier => verifier)
  puts "Handshake complete. You should remember the following credentials, which you will need for further requests:"
  puts " access token: #{access_token.token}"
  puts " access token secret: #{access_token.secret}"

  # And now we can start with real API calls :-)
  puts "\nYou are:"
  result = access_token.request(:get,
                                "https://api.xing.com/v1/users/me?fields=id,display_name,gender")
  puts result.body

  puts "\nand your amount of contacts is:"
  result = access_token.request(:get,
                                "https://api.xing.com/v1/users/me/contacts?limit=0")
  puts JSON.parse(result.body)["contacts"]["total"]
end
