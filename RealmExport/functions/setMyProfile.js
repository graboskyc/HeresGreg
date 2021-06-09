exports = function(id, pn, name, subscriptionstring){
  var conn = context.services.get("mongodb-atlas").db("greg").collection("profile");
  const opt = {upsert:true};
  const query = {userId:id};
  
  var subs = subscriptionstring.split(",");
  for (var i = 0; i < subs.length; i++) {
    subs[i] = subs[i].trim()
  }
  
  const obj = {pn:pn, name:name, subscriptions:subs};
  const up = {$set:obj};
  conn.updateOne(query, up, opt);
  return obj;
};