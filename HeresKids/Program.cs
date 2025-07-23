
using MongoDB.Driver;
using HeresKids.Datamodels;
using HeresKids.Components;
using Microsoft.AspNetCore.DataProtection;
using MongoDB.Bson;
using AspNetCore.Identity.Mongo;
using AspNetCore.Identity.Mongo.Model;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddRazorPages();
builder.Services.AddRazorComponents().AddInteractiveServerComponents();

builder.Services.AddHttpContextAccessor(); 
builder.Services.AddHttpClient();

builder.Services.AddDataProtection().PersistKeysToFileSystem(new DirectoryInfo("/var/keys"));

string MDBCONNSTR = Environment.GetEnvironmentVariable("MDBCONNSTR").Trim();

static void ConfigureMDBServices(IServiceCollection services, string connectionString)
{
    var settings = MongoClientSettings.FromConnectionString(connectionString);
    settings.ServerApi = new ServerApi(ServerApiVersion.V1);

    services.AddSingleton<IMongoClient>(new MongoClient(settings));
    //services.AddSingleton<IMongoDatabase>(x => x.GetRequiredService<IMongoClient>().GetDatabase("prism"));
}

ConfigureMDBServices(builder.Services, MDBCONNSTR);

builder.Services.AddIdentityMongoDbProvider<MongoUser, MongoRole>(identity =>
    {
        identity.User.RequireUniqueEmail = true;
        identity.Password.RequireNonAlphanumeric = false;
        identity.Password.RequireDigit = false;
        identity.Password.RequireUppercase = false;
        identity.Password.RequireLowercase = false;
        identity.Password.RequiredLength = 6;
        identity.SignIn.RequireConfirmedAccount = false;
    },
    mongo =>
    {
        mongo.ConnectionString = MDBCONNSTR;
    });

builder.Services.AddRazorComponents().AddInteractiveServerComponents();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Error", createScopeForErrors: true);
    // The default HSTS value is 30 days. You may want to change this for production scenarios, see https://aka.ms/aspnetcore-hsts.
    app.UseHsts();
}

app.UseAuthentication();
app.UseAuthorization();

app.UseHttpsRedirection();

app.UseStaticFiles();
app.UseAntiforgery();

app.MapRazorPages();
app.MapRazorComponents<App>().AddInteractiveServerRenderMode();

app.Run();
