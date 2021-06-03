#See https://aka.ms/containerfastmode to understand how Visual Studio uses this Dockerfile to build your images for faster debugging.

FROM mcr.microsoft.com/dotnet/aspnet:5.0-buster-slim AS base
ENV TZ="America/New_York"
WORKDIR /app
EXPOSE 80
EXPOSE 443

FROM mcr.microsoft.com/dotnet/sdk:5.0-buster-slim AS build
WORKDIR /src
COPY ["HeresKids/HeresKids.csproj", "HeresKids/"]
RUN dotnet restore "HeresKids/HeresKids.csproj"
COPY . .
WORKDIR "/src/HeresKids"
RUN dotnet build "HeresKids.csproj" -c Release -o /app/build

FROM build AS publish
RUN dotnet publish "HeresKids.csproj" -c Release -o /app/publish

FROM base AS final
WORKDIR /app
COPY --from=publish /app/publish .
ENTRYPOINT ["dotnet", "HeresKids.dll"]