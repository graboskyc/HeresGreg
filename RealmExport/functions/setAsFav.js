exports = async function(id){
  const currentUser = context.user;
  var d = new Date();
  
  var conn = context.services.get("mongodb-atlas").db("greg").collection("media");
  
  var oldDoc = await conn.findOne({_id:BSON.ObjectId(id)});
  var oldBool = oldDoc.isfavorite;
  
  await conn.updateOne({_id:BSON.ObjectId(id)}, {$set:{isfavorite : !oldBool}});
  
};