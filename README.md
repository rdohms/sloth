# Sloth - a PHP powered Slack integration environment

Slack is an amazing tool with amazing integrations. But sometimes those integrations are not enough, or too generic and you have to write your own payloads. Slack's webhooks and API are great and work wonderfully for this, however, writing an entire (small) application to add a simple integration is such a drag. 

## Enter Sloth!

Sloth is a HTTP shell that allows you to quickly write actions that can be hooked into slack and other tools as simple plugins, removing all the overhead of setting up an application and hooking up all the standard stuff. It is similar to chat bots such as Hubot and Lita, but with a focus on webhooks and not ChatOps (yet?). Initialy Sloth will make available a slack client, easy to setup and ready to go, allowing you to simply create a new url, handle your payload and translate it to a slack payload.

## Roadmap

* ~Working shell with sample action~
* Plugin structure: plugin should be easy to hook up
* Sample plugins from the author' library
* .. profit!

