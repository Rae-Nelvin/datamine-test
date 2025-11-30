@extends('user.auth-layout')

@section('main')
    <div class="flex flex-col gap-10">
        <div class="flex flex-col gap-2 text-center mb-10">
            <h1 class="text-xl md:text-2xl lg:text-4xl font-bold tracking-widest">Technical Assessment</h1>
            <h2 class="text-lg md:textxl lg:text-2xl font-semibold text-gray-800 tracking-wider">Leonardo Wijaya - Thursday, November 27th 2025</h2>
        </div>
        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md gap-4 flex flex-col">
            <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-gray-800 tracking-wide">How does Tailwind CSS differ from frameworks like Bootstrap in terms of workflow and customization?</h3>
            <h4 class="text-base md:text-lg lg:text-xl text-gray-700 font-medium leading-relaxed text-justify">
                Tailwind CSS is a utility-first CSS framework. Which means it provides low-level utility classes that can be composed to build custom designs directly to HTML body without ever need for modifying CSS files.
                From my experience, Tailwind CSS offers much more flexibility and customizations to all levels such as developers and the designs itself. Unlike Bootstrap which is component-based framework
                that provides pre-designed components that can be used to build user interfaces much more quicker but with limited customizations. From my experience, if you want to have a unique design by using Bootstrap,
                you need to override the default styles by writing custom CSS files which can lead to more complex and harder codebase to maintain. Also, Tailwind CSS has a Bootstrap kind of like extensions that I usually use to
                be able to create components as quick as possible which is ShadCN. This way, I can have the best of both worlds, quick development with high customizations. Also, for me personally
                when I use Tailwind CSS for the first time, it offers me much more learning experience about how CSS works under the hood since basically calling each classes that Tailwind CSS has is the same as writing CSS properties itself.
            </h4>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md gap-4 flex flex-col">
            <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-gray-800 tracking-wide">Explain how to build a responsive navigation bar using Tailwind CSS and Laravel Blade</h3>
            <h4 class="text-base md:text-lg lg:text-xl text-gray-700 font-medium leading-relaxed text-justify">
                Both top navigation bar or sidebar will rely to the same concept which is using transition, translate and transform utilities from Tailwind CSS to be able to show and hide the navigation bar based on the screen size.
                From my experience, I usually use a specific width size for the sidebar so the Tailwind CSS utility to translate the sidebar will be a lot easier. Other than that, the other main point to build a responsive
                navigation bar is to have a toggle button that will be used to show and hide the navigation bar on smaller screen sizes such as mobile devices.
            </h4>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md gap-4 flex flex-col">
            <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-gray-800 tracking-wide">Explain the MVC Architecture in Laravel</h3>
            <h4 class="text-base md:text-lg lg:text-xl text-gray-700 font-medium leading-relaxed text-justify">
                MVC which stands for Model View Controller is a software design pattern that separates the application logic into three interconnected components. In Laravel itself, the MVC architecture is basically the core of the framework.
                How it works is the Model represents the data and the business logic of the application and the database interactions. It basically handles data retrieval, storage, manipulation using Eloquent ORM in Laravel.
                The View is responsible for the representation layer of the application. It offers the user interface using Blade templating engine in Laravel by default. You can enhance it using frontend frameworks or libraries such as
                using Livewire or Inertia.js. The Controller acts as an intermediary between the Model and the View. Just like how the name is "Controller" which means it controls the flow of data and user requests. It receives input from users,
                process it using the Model, and then returns the appropriate View to be rendered. Overall, the MVC architecture in Laravel promotes separation of concerns, making the application more modular, maintainable, and scalable.
            </h4>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md gap-4 flex flex-col">
            <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-gray-800 tracking-wide">Have you worked with APIs before? Explain how you connected your code to another system or service.</h3>
            <h4 class="text-base md:text-lg lg:text-xl text-gray-700 font-medium leading-relaxed text-justify">
                Yes I have worked with APIs multiple time throughout my college year and also within my current job. Based on my experience, I have worked with API only using RESTful APIs. And the authentication method that I have used
                are mostly using API keys and sometimes using OAuth 2.0. I'll share my Bitrix24 experience as an example of how I connected my code to another system or service using APIs. Usually, before start of development, I will
                compile the API Documentations that's required for the data processing in the Bitrix24 side and share to the client. Once agreed, in Bitrix24, I will have to create a custom module first and then expose it in the Bitrix24
                framework itself and then share the API key and the endpoint URL to the client. Also, my rule of thumb is to be having logging on each endpoints that I have. Why? It's because to protect me from any unexpected issues that may occur.
                Most common issues that I was having is, Bitrix24 will automatically reject the API request due to broken JSON body request because other system doesn't sanitize the data properly. So having logging will help me to debug the issues
                much much more quicker and easier. Inside of the API endpoints itself, the flow will usually be like this. Validation will come at first, all required fields must be present and valid. Then, I will process the data either using
                custom Services or directly using ORM Models that Bitrix24 has provided to store the data if there are no post-processing required. Finally, I will return the response in the correct HTTP structure along with the proper
                status code and JSON body. I also make sure that each post-processing and validation to have try and catch block to make sure that if there are any errors, I can handle it properly. And each of the error handling will also be logged
                and be thrown back to the client with the proper HTTP Status code and JSON body.
            </h4>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md gap-4 flex flex-col">
            <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-gray-800 tracking-wide">Explain how does OAuth works.</h3>
            <h4 class="text-base md:text-lg lg:text-xl text-gray-700 font-medium leading-relaxed text-justify">
                OAuth which stands for Open Authorization is an open standard for access delegation commonly used as a way for Internet users to grant websites or applications access to their information on other websites without giving them the passwords.
                From my experience, OAuth works by allowing users to authorize third-party applications to access their resources on a resource server. The process usually involves several key components such as the Resource Owner, Client,
                Authorization Server, and Resource Server. The Resource Owner is the user who owns the data and wants to grant access to a third-party application. The Client is the third-party application that wants to access the user's data.
                The Authorization Server is responsible for authenticating the Resource Owner and issuing access tokens to the Client. The Resource Server is the server that hosts the user's data and validates the access tokens provided by the Client.
                The OAuth flow typically starts with the Client redirecting the Resource Owner to the Authorization Server to request authorization. Once the Resource Owner grants permission, the Authorization Server issues an authorization code
                to the Client. The Client then exchanges this authorization code for an access token by making a request to the Authorization Server. Finally, the Client uses this access token to access the protected resources on behalf of
                the Resource Owner from the Resource Server. Overall, OAuth provides a secure and standardized way for users to share their data with third-party applications without compromising their credentials.
            </h4>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md gap-4 flex flex-col">
            <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-gray-800 tracking-wide">What steps do you take to make sure your website or app is safe from security problems?</h3>
            <h4 class="text-base md:text-lg lg:text-xl text-gray-700 font-medium leading-relaxed text-justify">
                From my experience, the most important thing to make sure the website or app is safe from security problems is how do you manage the user inputs and data transfer within the applications itself. For the user inputs,
                it's highly recommended to be sanitize and validate properly so no malicious data such as SQL Injection or XSS or PHP Injection can get through the system. From my experience, since Bitrix24 already has built-in
                functions to sanitize and validate the user inputs, usually it won't be any issues. But for my personal projects or freelances, I usually use common and trusted front end frameworks such as React JS combined with Inertia.js.
                Other part is the data request and transfer that may occur in the API level and back end level. For API level, Bitrix24 also has built in API key authentication that I usually use to make sure that only authorized systems
                can access the API endpoints. Other than Bitrix24, I usually use Bearer Token authenticaion or JWT Token authentication. Now for back end level, I highly avoid to be using straight SQL queries both for Bitrix24 and
                other applications. Even like take for an example, Bitrix24 has built-in sanitizations for SQL queries, I'd still prefer to be using ORM first before falling back to straight SQL queries to avoid any SQL injections. And also,
                I never ever store any sensitive environment variables such as API keys, database credentials and any keys directly in the codebase. I'd always use environment variables like .env files and make sure each environment has
                their own .env like .env.development, .env.staging, .env.production and so on.
            </h4>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md gap-4 flex flex-col">
            <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-gray-800 tracking-wide">Have you worked with any CRM tools before? What did you use them for?</h3>
            <h4 class="text-base md:text-lg lg:text-xl text-gray-700 font-medium leading-relaxed text-justify">
                Bitrix24 is basically a CRM tools that my company uses to manage our clients and projects and also is the application that my company sells to our clients. Mainly, Bitrix24 CRM that we use internally is to manage
                our clients data such as contacts, companies, leads and deals. Other than that, we also use the Contact Center tools that integrated with WhatsApp, Live Chat, CRM Forms, Emails, Telephony and Ads Platfroms. Inside
                the Contact Center tool, we can sentralize the communication tools to be only using Bitrix24 without having to switch between multiple social media platforms or accounts. And we can invite other team members or colleagues
                to help out to answer the clients inquiries without any hassle. Other than that, I also have implemented any other use cases that can utilize Bitrix24 CRM such as managing Inventories stocks, managing Customer Complaints (Ticketing System) and
                managing business workflow for processing Claims.
            </h4>
        </div>

    </div>
@endsection
