# Upload

1. 定义URL和请求头：示例中定义了要上传文件的目标URL和HTTP请求的头部信息，其中包括 `User-Agent` 字段，用于标识浏览器类型。
2. 文件准备：在示例中，要上传的文件为 `catflag3.php` ，文件内容是 PHP 代码，用于读取 `/flag` 文件内容并输出。
3. 创建文件字典：使用files参数，创建一个文件字典，其中包含要上传的文件的名称、内容和类型（在示例中是 `image/png` ）。
   发送POST请求：使用 `requests.post()` 方法发送POST请求，并将文件字典作为参数传递。如果请求成功（状态码为200），代码会继续执行。
4. 检查上传状态：根据返回的响应文本内容，判断文件上传是否成功（示例中判断是否包含"Success"关键词）。
5. 下载上传的文件：如果上传成功，代码会构建一个新的URL，然后使用 `requests.get()` 方法发送GET请求，以下载刚刚上传的文件。
6. 检查文件内容：对于下载的文件，代码会检查其中是否包含 `'flag{'` ，如果有，则输出文件内容，否则输出提示信息。