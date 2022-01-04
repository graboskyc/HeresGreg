exports = async function(id){
  const currentUser = context.user
  var conn = context.services.get("mongodb-atlas").db("greg").collection("media");
  
  var pipeline =[{$match: {
  archived:false,
  _id:BSON.ObjectId(id)
}}, {$project: {
  isFavorite:{$switch: {
    branches: [
      {case:{$eq:[true, "$isfavorite"]}, then: true},
      {case:{$eq:["true", "$isfavorite"]}, then: true}
      ],
      default:false
  }
},
path:1,
babyname:1,
babycolor:1,
_id:1,
created:1
}}, {$sort: {
  _id: 1
}}];
  
  var docs = await conn.aggregate(pipeline).toArray();

  return docs[0];
};