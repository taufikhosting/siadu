<!--
now = new Date();
if (now.getTimezoneOffset() == 0) (a=now.getTime() + (7*60*60*1000))
else (a=now.getTime());
now.setTime(a);
document.write("" + ((now.getHours() < 10) ? "0" : "") + now.getHours() + ":" + ((now.getMinutes() < 10) ? "0" : "") + now.getMinutes() + ":" + ((now.getSeconds() < 10) ? "0" : "") + now.getSeconds() + (" WIB "))
//-->