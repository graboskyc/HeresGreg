exports = function(user){
  const validAdmins = context.values.get("validAdmins");
  if (validAdmins.indexOf(user.id) > -1) {
    return true;
  } else {
    return false;
  }
};