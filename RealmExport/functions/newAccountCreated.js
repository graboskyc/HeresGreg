exports = async function(authEvent) {
  const user = authEvent.user;
  var conn = context.services.get("mongodb-atlas").db("greg").collection("profile");
  
  var newProfile = {
    "isAdmin":false,
    "isArchived":false,
    "name":"",
    "userId":user.id,
    "subscriptions":[],
    "babies":[]
  };
  
  await conn.insertOne(newProfile);
};
