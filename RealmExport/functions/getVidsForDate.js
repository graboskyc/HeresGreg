exports = async function(year, month, baby){
  const currentUser = context.user
  var conn = context.services.get("mongodb-atlas").db("greg").collection("media");
  
  var pipeline = [{$match: {
  archived:false,
  $expr: {$eq:[parseInt(year), {$year:"$created"}]},
  $expr: {$eq:[parseInt(month), {$month:"$created"}]},
  babyname:baby

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
created:1,
createdby:1
}}];
  
  var docs = await conn.aggregate(pipeline).toArray();

  return docs;
};