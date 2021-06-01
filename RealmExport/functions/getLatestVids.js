exports = async function(){
  const currentUser = context.user
  var conn = context.services.get("mongodb-atlas").db("greg").collection("media");
  
  var pipeline =[{$match: {
  archived:false
}}, {$sort: {
  created:-1
}}, {$limit: 4}, {$project: {
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
created:1,
createdby:1
}}, {$sort: {
  _id: 1
}}];
  
  var docs = await conn.aggregate(pipeline).toArray();

  return docs;
};