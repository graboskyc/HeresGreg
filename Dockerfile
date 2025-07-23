#See https://aka.ms/containerfastmode to understand how Visual Studio uses this Dockerfile to build your images for faster debugging.

FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS base
ENV TZ="America/New_York"
WORKDIR /app
EXPOSE 80
EXPOSE 443

ADD crontab /etc/cron.d/resize-cron
RUN chmod 0644 /etc/cron.d/resize-cron
RUN touch /var/log/cron.log
RUN apt update
RUN apt install -y cron
COPY ffmpeg/resize.sh /ffmpeg/resize.sh
RUN cron

FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
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