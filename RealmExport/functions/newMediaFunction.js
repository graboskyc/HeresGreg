function cap(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function generateBody(u, b, s) {
  var bdyPossible = [
    "Hey %%USER%%, theres a new vid of %%BABY%% from %%SENDER%% so check Heres the Kids!",
    "New video of %%BABY%% uploaded by %%SENDER%% to Heres the Kids!",
    "New upload of %%BABY%% to Heres the Kids by %%SENDER%%",
    "A new video of %%BABY%% was uploaded by %%SENDER%% to Heres the Kids",
    "What are you waiting for? %%SENDER%% sent a new video of %%BABY%%"
  ];
  var m = bdyPossible[Math.floor(Math.random() * bdyPossible.length)];
  m = m.replace("%%USER%%", cap(u));
  m = m.replace("%%BABY%%", cap(b));
  m = m.replace("%%SENDER%%", cap(s));
  return m;
}

exports = async function(changeEvent) {
  var doc = changeEvent.fullDocument;
  
  var conn = context.services.get("mongodb-atlas").db("greg").collection("profile");
  const twilio = context.services.get("twil");
  const ourNumber = context.values.get("twilphone");

  let docs = await conn.find({pn:{$exists:true}, subscriptions:doc.babyname }).toArray();
  for(var i = 0; i < docs.length; i++) {
    twilio.send({
      from: ourNumber,
      to: docs[i].pn,
      //to: '+16097925029',
      body: generateBody(docs[i].username, doc.babyname, doc.createdby)
    });
  }
  return 

};