exports = async function(userid){
  var conn = context.services.get("mongodb-atlas").db("greg").collection("profile");
  const q = {"userId":userid};
  var retval = {};
  await conn.findOne(q)
  .then((result) => {
    if (result) {
      retval = result;
    }
  });
  return retval;
  }