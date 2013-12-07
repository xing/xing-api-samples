begin
  require 'xing_api'

  puts "Please open the following URL in your browser:"
  puts " https://dev.xing.com/applications"
  print "and enter the consumer key: "
  consumer_key = gets.strip

  print "enter the consumer secret here: "
  consumer_secret = gets.strip

  client = XingApi::Client.new(
    consumer_key: consumer_key,
    consumer_secret: consumer_secret
  )

  # Step 1: Obtain a request token
  # more info -> https://dev.xing.com/docs/authentication#call_v1_request_token
  puts "\nStarting oauth handshake, ask for request token..."
  request_token = client.get_request_token

  # Step 2: Obtain user authorization
  # more info -> https://dev.xing.com/docs/authentication#call_v1_authorize
  puts "\nPlease open the following URL in your browser:"
  puts "#{request_token[:authorize_url]}"
  print "\nand enter the PIN here: "
  verifier = gets.strip

  # Step 3: Exchange the authorized request token for an access token
  # more info -> https://dev.xing.com/docs/authentication#call_v1_access_token
  puts "\nExchanging request token for your access token..."
  access_token = client.get_access_token(verifier)
  puts "Handshake complete. You should remember the following credentials, which you will need for further requests:"
  puts " access token: #{access_token[:access_token]}"
  puts " access token secret: #{access_token[:access_token_secret]}"

  # And now we can start with real API calls :-)
  puts "\nYou are:"
  puts XingApi::User.me(client: client, fields: 'id,display_name,gender')[:users].first

  puts "\nand your amount of contacts is:"
  puts XingApi::Contact.list('me', client: client, limit: 0)[:contacts][:total]
end
