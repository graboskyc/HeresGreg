using System.Collections.Generic;
using MongoDB.Bson;
using MongoDB.Bson.Serialization.Attributes;

namespace HeresKids.Datamodels
{
    [BsonIgnoreExtraElements]
    class Babies
    {
        public string _id { get; set; }
        public string name { get; set; }
        public string babycolor { get; set; }
    }
}