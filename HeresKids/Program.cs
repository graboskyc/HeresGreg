
using MongoDB.Driver;
using HeresKids.Datamodels;
using HeresKids.Components;
using Microsoft.AspNetCore.DataProtection;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddRazorComponents().AddInteractiveServerComponents();

builder.Services.AddHttpContextAccessor(); 
builder.Services.AddHttpClient();

builder.Services.AddDataProtection().PersistKeysToFileSystem(new DirectoryInfo("/var/keys"));

static void ConfigureMDBServices(IServiceCollection services)
{
    
    string MDBCONNSTR = Environment.GetEnvironmentVariable("MDBCONNSTR");
    var settings = MongoClientSettings.FromConnectionString(MDBCONNSTR);
    settings.ServerApi = new ServerApi(ServerApiVersion.V1);

    services.AddSingleton<IMongoClient>(new MongoClient(settings));
    //services.AddSingleton<IMongoDatabase>(x => x.GetRequiredService<IMongoClient>().GetDatabase("prism"));
}

ConfigureMDBServices(builder.Services);


var app = builder.Build();

// Configure the HTTP request pipeline.
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Error", createScopeForErrors: true);
    // The default HSTS value is 30 days. You may want to change this for production scenarios, see https://aka.ms/aspnetcore-hsts.
    app.UseHsts();
}

app.UseHttpsRedirection();

app.UseStaticFiles();
app.UseAntiforgery();

app.MapRazorComponents<App>().AddInteractiveServerRenderMode();

app.Run();
