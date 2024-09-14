using Microsoft.AspNetCore.Components;
using Microsoft.AspNetCore.Components.Web;
using MongoDB.Driver;
using HeresKids.Datamodels;
using Microsoft.AspNetCore.Authentication; 
using Microsoft.AspNetCore.Authentication.Cookies;
using Microsoft.AspNetCore.Components.Authorization;
using System.Net.Http;
using Microsoft.AspNetCore.HttpOverrides;
using Auth0.AspNetCore.Authentication;
using Microsoft.Extensions.DependencyInjection;
using HeresKids;

var builder = WebApplication.CreateBuilder(args);

builder.Services
    .AddAuth0WebAppAuthentication(options => {
      options.Domain = Environment.GetEnvironmentVariable("AUTH0DOMAIN").Trim();
      options.ClientId = Environment.GetEnvironmentVariable("AUTH0CLIENTID").Trim();
    });

// Add services to the container.
builder.Services.AddRazorPages();
//builder.Services.AddServerSideBlazor();
builder.Services.AddRazorComponents().AddInteractiveServerComponents();

builder.Services.AddHttpClient();

static void ConfigureMDBServices(IServiceCollection services)
{
    
    string MDBCONNSTR = Environment.GetEnvironmentVariable("MDBCONNSTR").Trim();
    var settings = MongoClientSettings.FromConnectionString(MDBCONNSTR);
    settings.ServerApi = new ServerApi(ServerApiVersion.V1);

    services.AddSingleton<IMongoClient>(new MongoClient(settings));
    services.AddSingleton<IMongoDatabase>(x => x.GetRequiredService<IMongoClient>().GetDatabase("brennan"));
    //services.AddSingleton<IMongoCollection<PreregForm>>(x => x.GetRequiredService<IMongoDatabase>().GetCollection<PreregForm>("preregistration"));
}

ConfigureMDBServices(builder.Services);

var app = builder.Build();

app.MapGet("/Account/Login", async (HttpContext httpContext, string returnUrl = "/") =>
{
  var authenticationProperties = new LoginAuthenticationPropertiesBuilder()
          .WithRedirectUri(returnUrl)
          .Build();

  await httpContext.ChallengeAsync(Auth0Constants.AuthenticationScheme, authenticationProperties);
});

app.MapGet("/Account/Logout", async (HttpContext httpContext) =>
{
  var authenticationProperties = new LogoutAuthenticationPropertiesBuilder()
          .WithRedirectUri("/")
          .Build();

  await httpContext.SignOutAsync(Auth0Constants.AuthenticationScheme, authenticationProperties);
  await httpContext.SignOutAsync(CookieAuthenticationDefaults.AuthenticationScheme);
});

// Configure the HTTP request pipeline.
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Error");
    // The default HSTS value is 30 days. You may want to change this for production scenarios, see https://aka.ms/aspnetcore-hsts.
    app.UseHsts();
}

app.UseForwardedHeaders(new ForwardedHeadersOptions {
  ForwardedHeaders = ForwardedHeaders.XForwardedProto
});

app.UseHttpsRedirection();

app.UseStaticFiles();

app.UseRouting();

//app.MapBlazorHub();
app.MapRazorComponents<App>().AddInteractiveServerRenderMode();
//app.MapFallbackToPage("/_Host");

app.UseAntiforgery();


app.Run();
