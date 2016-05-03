package com.xing.dev;

import java.util.Scanner;

import com.github.scribejava.apis.XingApi;
import com.github.scribejava.core.builder.*;
import com.github.scribejava.core.model.*;
import com.github.scribejava.core.oauth.*;

public class XingExample {

    public static void main(String[] args) {
        String apiKey       = "";
        String apiSecret    = "";
        String callUrl      = "";

        // Interact via Commandline
        Scanner input = new Scanner(System.in);

        System.out.println("=== Example to use the XING API ===");

        // Entering the API-key
        System.out.println("Please enter your API-key:");
        System.out.print(">> ");
        apiKey = input.nextLine();

        // Entering the API-secret
        System.out.println("Please enter your API-secret:");
        System.out.print(">> ");
        apiSecret = input.nextLine();

        // Entering the API-call you would like to perform
        System.out.println("Now you need to set up the call you'd like to perform.");
        System.out.println("In case you don't enter something the \"users me\"-call would be performed.");
        System.out.println("In case you want to perform a different call please enter the related call URL:");
        System.out.print(">>");
        callUrl = input.nextLine();
        if (callUrl.isEmpty()) {
            callUrl = "https://api.xing.com/v1/users/me";
        }

        // Initializing OAuth - Service
        OAuth10aService service = new ServiceBuilder()
                .apiKey(apiKey)
                .apiSecret(apiSecret)
                .build(XingApi.instance());

        // Obtain the Request Token
        System.out.println("Fetching the Request Token...");
        OAuth1RequestToken requestToken = service.getRequestToken();
        System.out.println("Got the Request Token!");
        System.out.println();

        System.out.println("Now go and authorize this example call here:");
        System.out.println(service.getAuthorizationUrl(requestToken));
        System.out.println("And paste the verifier here");
        System.out.print(">> ");
        String verifier = input.nextLine();
        System.out.println();

        // Trade the Request Token and Verfier for the Access Token
        System.out.println("Trading the Request Token for an Access Token...");
        OAuth1AccessToken accessToken = service.getAccessToken(requestToken, verifier);
        System.out.println("Got the Access Token!");
        System.out.println("(if your curious it looks like this: " + accessToken + " )");
        System.out.println();

        // Now let's go and ask for a protected resource!
        System.out.println("Now we're going to access a protected resource...");
        OAuthRequest request = new OAuthRequest(Verb.GET, callUrl, service);
        service.signRequest(accessToken, request);
        Response response = request.send();
        System.out.println("Got it! Lets see what we found...");
        System.out.println();
        System.out.println(response.getBody());
    }
}