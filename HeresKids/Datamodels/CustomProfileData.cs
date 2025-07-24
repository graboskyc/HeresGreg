using System.Collections.Generic;
using MongoDB.Bson;
using MongoDB.Bson.Serialization.Attributes;

namespace HeresKids.Datamodels
{
    [BsonIgnoreExtraElements]
    class CustomProfileData {
        public string pn{get;set;}
        public string name{get;set;}
        public List<string> subscriptions {get;set;}
    }
}