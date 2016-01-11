 <?php
$hub = new NotificationHub("Endpoint=sb://watelevel.servicebus.windows.net/;SharedAccessKeyName=DefaultFullSharedAccessSignature;SharedAccessKey=ccFdd8pOy8DkLvUmvCEu4zcGRBrdicjPXKmhtYH9cF8=", "watelevel"); 
$toast = '<toast><visual><binding template="ToastText01"><text id="1">Hello from PHP!</text></binding></visual></toast>';
$notification = new Notification("windows", $toast);
$notification->headers[] = 'X-WNS-Type: wns/toast';
echo ("test");
$hub->sendNotification($notification);
