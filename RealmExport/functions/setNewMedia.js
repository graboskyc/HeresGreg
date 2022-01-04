exports = async function(babyname, babycolor, filename){
  const currentUser = context.user;
  var d = new Date();
  
  var conn = context.services.get("mongodb-atlas").db("greg").collection("media");
  
  var doc = {};
  doc.created = d;
  doc.path = filename;
  doc.creator = currentUser;
  doc.createdby = (currentUser.custom_data.name || currentUser.data.email.split("@")[0]);
  doc.isfavorite = false;
  doc.archived = false;
  doc.babyname = babyname;
  doc.babycolor = babycolor;
  
  await conn.insertOne(doc);
};