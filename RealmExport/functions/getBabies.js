exports = async function(){
  const currentUser = context.user
  var conn = context.services.get("mongodb-atlas").db("greg").collection("babies");
  
  var pipeline =[{$sort: {_id: 1}}];
  
  var docs = await conn.aggregate(pipeline).toArray();

  return docs;
};