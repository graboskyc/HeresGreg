using System.Collections.Generic;
using MongoDB.Bson;
using MongoDB.Bson.Serialization.Attributes;

namespace HeresKids.Datamodels
{
    [BsonIgnoreExtraElements]
    public class VideoListItem
    {
        public ObjectId _id { get; set; }
        public DateTime created { get; set; }
        public bool isFavorite { get; set; }
        public string path { get; set; }
        public string babyname { get; set; }
        public string babycolor { get; set; }
        public string createdby { get; set; }
        public bool archived { get; set; }
        public string CreatedByEmail { get; set; } 

    }
}