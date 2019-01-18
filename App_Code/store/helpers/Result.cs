namespace helpers
{
    public class DummyResult
    {
    }

    public class ResultError
    {
        private readonly string message;

        public string Message
        {
            get
            {
                return message;
            }
        }

        public ResultError(string message)
        {
            this.message = message;
        }
    }

    public class Result<ResultType>
    {
        private readonly ResultType resource;
        private readonly ResultError error;

        public ResultError Error
        {
            get
            {
                return error;
            }
        }

        public ResultType Resource
        {
            get
            {
                return resource;
            }
        }

        public Result(ResultType resource, ResultError error)
        {
            this.resource = resource;
            this.error = error;
        }

        public bool isSuccessful()
        {
            return Resource != null && error == null;
        }
    }
}