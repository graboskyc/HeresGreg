exports = async function(){
  const currentUser = context.user
  var conn = context.services.get("mongodb-atlas").db("greg").collection("media");
  
  var pipeline = [{$group: {
  _id: {
    forYear: {
      $year: '$created'
    },
    forMonth: {
      $month: '$created'
    },
    baby: '$babyname',
    color:"$babycolor"
  },
  ct: {
    $sum: 1
  }
}}, {$sort: {
  '_id.forYear': -1,
  '_id.forMonth': -1,
  '_id.baby': 1
}}, {$project: {
  forYear:"$_id.forYear",
  forMonth:"$_id.forMonth",
baby:"$_id.baby",
    color:"$_id.color",
  ct:1,
  _id:0
}}];
  
  var docs = await conn.aggregate(pipeline).toArray();

  return docs;
};