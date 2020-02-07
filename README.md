# Magento 2 Missing Product Images Report

This Magento 2 module creates a landing page in the admin backend with a list of all the visible products that do not have images linked to them. The list is in grid form, can be filtered and has an edit link for every products as a quick way to add images.

<img src="https://i.ibb.co/H72pKh4/screenshot.png" alt="screenshot" border="1">



Istallation steps

1. Create a folder titled "Dacod" in your Magento root/app/code.

2. Under the folder above ("Dacod") create a folder titled "MissingProductImagesReport". All in all your folder structure from the Magento root folder should be /app/code/Dacod/MissingProductImagesReport.

3. Download the contents of this repository into the folder above ("MissingProductImagesReport").

4. From the Magento root folder, via the Command Line Interface run the following commands:


	A. `php bin/magento module:enable Dacod_MissingProductImagesReport`

	B. `php bin/magento setup:upgrade`

	C. `php bin/magento setup:static-content:deploy -f`

	D. `php bin/magento module:enable cache:clean`

5. Go to 'Catalog > Missing Product Images Report' on the backend for filterable list of visible products (Catalog, Search / Catalog / Search)


# License


MIT License

Copyright (c) 2020 Dacod Magagula

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
