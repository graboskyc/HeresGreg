exports = async function(id){
  const currentUser = context.user;
  var d = new Date();
  
  var conn = context.services.get("mongodb-atlas").db("greg").collection("media");
  
  await conn.updateOne({_id:BSON.ObjectId(id)}, {$set:{archived : true}});
  
};