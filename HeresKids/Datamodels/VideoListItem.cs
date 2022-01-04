using System;

namespace HeresKids.Datamodels
{
    class VideoListItem {
        public string _id {get; set;}
        public DateTime created {get;set;}
        public bool isFavorite {get;set;}
        public string path {get; set;}
        public string babyname {get; set;}
        public string babycolor {get; set;}
        public string createdby {get; set;}

    }
}