using System.Collections.Generic;
using MongoDB.Bson;
using MongoDB.Bson.Serialization.Attributes;

namespace HeresKids.Datamodels
{
    [BsonIgnoreExtraElements]
    class BabyGrouping {
        public int forYear {get; set;}
        public int forMonth {get;set;}
        public int ct {get;set;}

        public string baby {get;set;}
        public string color {get;set;}

    }
}