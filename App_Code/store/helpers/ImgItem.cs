namespace helpers
{
    public class ImgItem
    {
        private readonly string id;
        private readonly string imageUrl;        

        public string ImageUrl
        {
            get
            {
                return imageUrl;
            }
        }

        public string Id
        {
            get
            {
                return id;
            }
        }

        public ImgItem(string id, string imageUrl)
        {
            this.id = id;
            this.imageUrl = imageUrl;
        }
    }
}
